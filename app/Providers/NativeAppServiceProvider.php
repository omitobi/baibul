<?php

namespace App\Providers;

use Native\Laravel\Client\Client;
use Native\Laravel\Facades\ContextMenu;
use Native\Laravel\Facades\Dock;
use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Facades\Window;
use Native\Laravel\Facades\GlobalShortcut;
use Native\Laravel\Menu\Menu;

class NativeAppServiceProvider
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        $window = new \Native\Laravel\Windows\PendingOpenWindow('main');
        $window->position(1500, 0)
            ->width(420)
            ->height(340)
            ->alwaysOnTop()
            ->resizable(false)
            ->backgroundColor('#00000050')
//            ->closable(false)
            ->maximizable(false)
            ->minimizable(false);

        $window2 = new \Native\Laravel\Windows\PendingOpenWindow('main');
        $window2->position(1500, 0)
            ->width(1000)
            ->height(1000)
            ->alwaysOnTop()
            ->resizable(false)
            ->backgroundColor('#00000050')
//            ->closable(false)
            ->maximizable(false)
            ->minimizable(false);

        $window2->setClient(app(Client::class));


//            ->movable(false)
//            ->rememberState();
//        Window::open()
//            ->position(1500, 0)
//            ->width(420)
//            ->height(340)
//            ->alwaysOnTop()
//            ->resizable(false)
//            ->backgroundColor('#00000050')
////            ->closable(false)
//            ->maximizable(false)
//            ->minimizable(false);
//            ->movable(false)
//            ->rememberState();

        Menu::new()
            ->appMenu()
            ->submenu(
                'About',
                Menu::new()->link('https://omitobisam.com', 'Transprime Research')
            )
            ->register();
//
//        MenuBar::create()
//            ->showDockIcon();


        /**
            Dock::menu(
                Menu::new()
                    ->event(DockItemClicked::class, 'Settings')
                    ->submenu('Help',
                        Menu::new()
                            ->event(DockItemClicked::class, 'About')
                            ->event(DockItemClicked::class, 'Learn More…')
                    )
            );

            ContextMenu::register(
                Menu::new()
                    ->event(ContextMenuClicked::class, 'Do something')
            );

            GlobalShortcut::new()
                ->key('CmdOrCtrl+Shift+I')
                ->event(ShortcutPressed::class)
                ->register();
        */
    }
}
