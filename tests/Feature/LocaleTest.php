<?php


it('changes the locale and stores it in the session', function () {
    $response = $this->get('/locale/en');

    $response->assertSessionHas('locale', 'en');
    $response = $this->get('/locale/ru');

    $response->assertSessionHas('locale', 'ru');
});
