<?php

namespace App\Providers;

use Native\Laravel\Facades\ContextMenu;
use Native\Laravel\Facades\Dock;
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

//        dd($feed);
        Window::open()
            ->position(1500, 0)
            ->width(400)
            ->height(300)
            ->alwaysOnTop()
            ->resizable(false)
//            ->closable(false)
            ->maximizable(false)
            ->minimizable(false);
//            ->movable(false)
//            ->rememberState();

        Menu::new()
            ->appMenu()
            ->submenu('About', Menu::new()
                ->link('https://beyondco.de', 'Beyond Code')
                ->link('https://simonhamp.me', 'Simon Hamp')
            )
            ->submenu('View', Menu::new()
                ->toggleFullscreen()
                ->separator()
                ->link('https://laravel.com', 'Learn More', 'CmdOrCtrl+L')
            )
            ->register();

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
