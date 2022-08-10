<?php
function start_timer(): int
{
    /**
     * Start a timer for measuring the runtime.
     * Pass this value to the end_timer function.
     * 
     * @return int
     */
    return microtime(true);
}

function end_timer(int $timer_start): int
{
    /**
     * Return the time difference between the start time and the current time
     * Used to measure performance 
     * 
     * @param int the value received from start_timer
     * 
     * @return void
     */
   return (microtime(true)-$timer_start)*1000;
}

function check_debug_ip(): bool
{
    /**
     * Check if the current IP address is listed as a debug ip
     * Can be used to run test code on a live website.
     * 
     * (list defined in the config file)
     * 
     * @return bool
     */
    global $debug_ips;
    return in_array($_SERVER['REMOTE_ADDR'], $debug_ips);
}

function dump($data, bool $ip_check = true): void
{
    /**
     * Prints value in a readable pop-up.
     * Prints additional info about where it was called.
     * 
     * Used for debugging
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