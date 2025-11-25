<?php

use PHPUnit\Framework\TestCase;
use Sprout\Helpers\Pdb;

/**
 *
 */
class CronTest extends TestCase
{

    public function testCron()
    {
        // Hack fix the interpreter which comes up as 'composer' instead of 'php'.
        putenv('_=' . PHP_BINARY);

        Pdb::delete('cron_jobs', ['name' => 'Demo Cron']);

        $cmd = __DIR__ . '/web/index.php cron_job/run/demo';

        $res = shell_exec("exec php {$cmd} &");
        $this->assertNotFalse($res);

        $res = shell_exec("exec php {$cmd} &");
        $this->assertNotFalse($res);

        sleep(4);

        $jobs = Pdb::find('cron_jobs')
            ->where(['name' => 'Demo Cron'])
            ->orderBy('id asc')
            ->limit(2)
            ->all();

        $this->assertCount(2, $jobs);

        $this->assertEquals('Demo Cron', $jobs[0]['name']);
        $this->assertEquals('Demo Cron', $jobs[1]['name']);

        $this->assertEquals('Success', $jobs[0]['status']);
        $this->assertEquals('Success', $jobs[1]['status']);

        // This becomes our reference.
        $time = strtotime($jobs[0]['date_added']);

        $added = date('Y-m-d H:i:s', strtotime('+2 second', $time));
        $this->assertEquals($added, $jobs[1]['date_added']);

        // Modified date isn't great, but it's what we've got for now.
        $finished = date('Y-m-d H:i:s', strtotime('+2 second', $time));
        $this->assertEquals($finished, $jobs[0]['date_modified']);

        $finished = date('Y-m-d H:i:s', strtotime('+4 second', $time));
        $this->assertEquals($finished, $jobs[1]['date_modified']);
    }
}
