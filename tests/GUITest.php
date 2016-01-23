<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GUITest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Serenity CMS')
             ->see('All Elements')
             ->see('Accordion')
             ->see('Default Block')
             ->see('Tabs Heading')
             ->see('Alerts')
             ->see('Callouts')
             ->see('Info Callout')
             ->see('Názov')
             ->see('Progress Bars')
             ->see('Im content in <code>.well</code>.')
             ->see('Test button')
             ->see('Click me!')
             ->see('fa fa-google-plus');
    }
}
