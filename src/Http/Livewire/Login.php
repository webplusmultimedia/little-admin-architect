<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Http\Livewire;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Facades\LittleAdminManager;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Button;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\InteractsWithForms;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\HasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBox;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;
use Webplusmultimedia\LittleAdminArchitect\Http\Responses\Auth\LoginResponse;

/**
 * @property Form $form
 */
class Login extends Component implements HasForm
{
    use InteractsWithForms;
    use WithRateLimiting;

    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function mount(): void
    {

        if (LittleAdminManager::auth()->check()) {
            redirect()->intended(LittleAdminManager::getUrl());
        }

        $this->form->model(['email' => $this->email, 'password' => $this->password, 'remember' => $this->remember]);
    }

    protected function getFormSchemas(): array
    {
        return [
            Input::make('email')
                ->email()
                ->label(__('little-admin-architect::login.fields.email.label'))
                ->required(),
            Input::make('password')
                ->required()
                ->password()
                ->label(__('little-admin-architect::login.fields.password.label')),
            CheckBox::make('remember')
                ->label(__('little-admin-architect::login.fields.remember.label'))
                ->default(false),
        ];
    }

    public function authenticate(): ?LoginResponse
    {

        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            throw ValidationException::withMessages([
                'email' => __('little-admin-architect::login.messages.throttled', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]),
            ]);
        }
        $this->form->model(['email' => $this->email, 'password' => $this->password, 'remember' => $this->remember]);
        $data = $this->form->getState();

        if ( ! LittleAdminManager::auth()->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $data['remember'])) {
            throw ValidationException::withMessages([
                'email' => __('little-admin-architect::login.messages.failed'),
            ]);
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }

    protected function getForm(): ?Form
    {
        if ( ! $this->_form) {
            $this->_form = Form::make(__('little-admin-architect::login.heading'))
                ->schema($this->getFormSchemas())
                ->setButtonSave(Button::make(__('little-admin-architect::login.buttons.submit.label'), 'submit', 'authenticate'));
            $this->_form->livewireId($this->id);
        }

        return $this->_form;
    }

    public function render(): View
    {
        return view('little-views::admin-components.login', ['form' => $this->form])
            ->layout('little-views::admin-components.Layouts.login-card');
    }
}
