<?php
/**
 * Class SendRefreshSignal
 *
 * @package    namespace App\Components\Refresh;
 * @version    1.0.0
 * @author     Tor Miller
 * @copyright  (c) 2015-2017, Bizly.co
 */

namespace App\Components\Refresh;

use App\Events\Refresh\RefreshSignal;
use Illuminate\Console\Command;

class SendRefreshSignal extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:refresh-browser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a signal that the dashboard uses to refresh/hard load the page when code is updated.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        event(new RefreshSignal());
    }
}
