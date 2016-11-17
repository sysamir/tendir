<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Statistics extends AbstractWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view('admin.panel.widgets.statistics');
    }
}