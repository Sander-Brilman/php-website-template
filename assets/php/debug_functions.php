<?php
function start_timer()
{
    /**
     * Start a timer for measuring the runtime.
     * Store the return value in a variable.
     * 
     * @return int
     */
    return microtime(true);
}

function end_timer(int $timer_start, string $feedback)
{
    /**
     * Echo the result of the timer
     * 
     * @param int the value received from start_timer
     * 
     * @param string additional message to be printed
     * 
     * @return void
     */
    echo "milliseconds passed for $feedback -> ".(microtime(true)-$timer_start)*1000;
}

function check_debug_ip()
{
    /**
     * Check if the current IP adress is as a debug ip
     * 
     * @return bool
     */
    global $debug_ips;
    return in_array($_SERVER['REMOTE_ADDR'], $debug_ips);
}

function dump($data, bool $ip_check = true) 
{
    /**
     * Dumps value in a readable pop-up.
     * Prints additional caller info aswell.
     * 
     * @param mixed the value to be dumped
     * 
     * @return void
     */
    if ($ip_check && !check_debug_ip()) {
        return;
    }

    $caller = debug_backtrace();
    $caller = array_pop($caller);
    $style  = 'z-index: 9999; border: red solid 2px; background: white;';
    ?>
    <div style="<?= $style ?>">
        <p>
            Called from: 
            <?php 
            echo '<b>'.$caller["file"].'</b>'; 
            echo ($caller["function"] != 'dump' ? 'from '.$caller["function"] : ''). ' ';
            echo 'on line <b>'.$caller["line"].'</b>';
            ?>
        </p>
        <pre>
            <?php
                var_dump($data);
            ?>
        </pre>
    </div>
    <?php
}
?>