<?php

use App\Jobs\DemoJob;

test('test-job', function () {
    $job = (new DemoJob(123))->withFakeQueueInteractions();

    $job->handle();

    $job->assertReleased(30);
});
