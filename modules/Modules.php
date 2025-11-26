<?php

namespace Divi_toc\Modules;

use Divi_toc\Modules\TableOfContentsModule\TableOfContentsModule;
// plus whatever Divi 5 ModuleRegistration class the example repo uses

class Modules {
    public static function register() {
        // This MUST register the module with Divi 5,
        // using the module.json path and callbacks in TableOfContentsModule.
        TableOfContentsModule::register();
    }
}
