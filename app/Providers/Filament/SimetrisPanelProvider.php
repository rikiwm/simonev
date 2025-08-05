<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Enums\Width;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
class SimetrisPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->font('Google Sans')
            ->brandLogo(asset('assets/lg.png'))
            ->brandName('Simetris')->favicon(asset('assets/ico.png'))
            ->brandLogoHeight('2rem')
            ->spa(true)
             ->navigationGroups([
            NavigationGroup::make('Monitoring')
                 ->label('Monitoring'),
             ])
               ->navigationItems([
            // NavigationItem::make('Kinerja')
            //     // ->url(fn () => route('filament.simetris.apbd.index'))
            //     ->group('Monitoring')
            //     ->sort(3),
                  NavigationItem::make('Kerja')
                // ->url('https://filament.pirsch.io', shouldOpenInNewTab: true)
                ->group('Monitoring')
                ->sort(3),
                  NavigationItem::make('Evaluasi')
                // ->url('https://filament.pirsch.io', shouldOpenInNewTab: true)

                ->group('Monitoring')
                ->sort(3),
        ])
            ->id('simetris')
            ->path('simetris')
            ->login()
            ->subNavigationPosition(SubNavigationPosition::Top)
              ->sidebarFullyCollapsibleOnDesktop()
            ->maxContentWidth(Width::ScreenExtraLarge)
            ->profile(isSimple: false)
             ->broadcasting(false)
            ->sidebarWidth('18rem')
            ->colors([
                'primary' => Color::Amber,
                'secondary' => Color::Purple,
            ])

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
