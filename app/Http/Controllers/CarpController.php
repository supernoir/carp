<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CarpController extends Controller
{
    protected $columns;

    public function arpSweep()
    {
        $output = shell_exec('arp -a');
        $lines = explode("\n", trim($output));
        return $lines;
    }

    public function arpPing($ip)
    {
        $output = shell_exec('arp -n ' . $ip);
        $lines = explode("\n", trim($output));
        return $lines;
    }

    public function getArpSweepColumns()
    {
        $columns = [
            'name',
            'ip',
            'at',
            'mac',
            'on',
            'interface',
            'status',
            'connectionType'
        ];
        return $columns;
    }

    public function displaySweep()
    {
        return view('app', [
            'arpSweepColumns' => $this->getArpSweepColumns(),
            'arpResults' => $this->arpSweep(),
            'arpSweepAction' => 'Sweep',
        ]);
    }
}
