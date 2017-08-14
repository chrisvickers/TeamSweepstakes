<?php

namespace App\Traits;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Exception;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Exception\WebDriverException;
use Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

// https://github.com/facebook/php-webdriver/wiki/Example-command-reference

/**
 * run this in project root. might need to reboot afterwards.
 * ==============================================================================================
 * sudo apt-get update
 * sudo apt-get -y install libxpm4 libxrender1 libgtk2.0-0 libnss3 libgconf-2-4
 * sudo apt-get install chromium-browser
 * sudo apt-get -y install xvfb gtk2-engines-pixbuf
 * sudo apt-get -y install xfonts-cyrillic xfonts-100dpi xfonts-75dpi xfonts-base xfonts-scalable
 * sudo apt-get -y install imagemagick x11-apps
 * sudo chmod a+x chromedriver-linux.
 */
trait InteractsWithRemoteWebDriver
{
    /**
     * @var string
     */
    protected $chromedriver_path = 'chromedriver-linux';

    /**
     * @var int
     */
    protected $max_attempts = 3;

    /**
     * @var Process
     */
    protected $process;

    /**
     * @var RemoteWebDriver
     */
    protected $driver;

    /**
     * Take a screenshot and upload to remote storage.
     *
     * @return string
     */
    public function save_screen_shot()
    {
        $file = gethostname().'_'.time().'.png';
        $this->driver->takeScreenshot(storage_path($file));
        $image = Image::make(storage_path($file));
        $output = (string) $image->encode('png');
        $storagename = 'scraper_screenshots/'.$file;

        Storage::disk('s3')->put($storagename, $output);

        unlink(storage_path($file));

        return 'https://s3.amazonaws.com/myshopmanager/scraper_screenshots/'.$file;
    }

    /**
     * Start the chromium process.
     */
    public function start_driver()
    {
        $result = exec('xdpyinfo -display :0 >/dev/null 2>&1 && echo "1" || echo "0"');

        if ($result == '0') {
            exec('Xvfb -ac :0 -screen 0 1280x1024x16 &');
        }

        $i = 0;

        while ($i <= $this->max_attempts) {
            $i++;
            $this->process = (new ProcessBuilder())
                ->setPrefix(base_path($this->chromedriver_path))
                ->getProcess()
                ->setEnv(['DISPLAY' => ':0']);

            $this->process->start();
            $this->driver = RemoteWebDriver::create('http://localhost:9515', DesiredCapabilities::chrome());
            break;
        }

        if ($i > $this->max_attempts) {
            throw new WebDriverException('Failed to start remote web driver. Max attempts reached.');
        }
    }

    /**
     * Stop the chromium process.
     */
    public function stop_driver()
    {
        try {
            if ($this->driver) {
                foreach ($this->driver->getWindowHandles() as $handle) {
                    $this->driver->switchTo()->window($handle);
                    $this->driver->close();
                }
                $this->driver->quit();
                $this->process->stop();
            }
        } catch (Exception $e) {
        }
    }


}