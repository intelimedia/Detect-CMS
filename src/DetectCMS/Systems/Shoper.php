<?php
namespace DetectCMS\Systems;

/**
 *
 * @author Przemysław Prekurat <p.prekurat@intelimedia.pl>
 */
class Shoper extends \DetectCMS\DetectCMS
{
    /** @var string[] */
    public $methods;

    /** @var  string */
    public $home_html;
    public $home_headers;
    /** @var string */
    public $url;

    /**
     * @param string $home_html
     * @param $home_headers
     * @param string $url
     */
    public function __construct($home_html, $home_headers, $url)
    {
        $this->home_headers = $home_headers;
        $this->home_html = $home_html;
        $this->url = $url;

        $this->methods = array(
            'checkResponseHeader',
            'checkHtmlBody',
        );
    }

    /**
     * Check for powered-by header
     * @return [boolean]
     */
    public function checkResponseHeader() {

      if (is_array($this->home_headers)) {

        foreach ($this->home_headers as $line) {
          if (stripos($line, "powered-by") !== false && stripos($line, "DCSaaS") !== false) {
            return true;
          }
        }
      }

      return false;
    }

    /**
     * @return bool
     */
    public function checkHtmlBody()
    {
      if (strpos($this->home_html, 'if (window.ShopInstance)') !== false
        || strpos($this->home_html, 'if (window.shoper)') !== false
        || strpos($this->home_html, 'Shop.basket.basketProducts') !== false
      ) {
        return true;
      }

      return false;
    }
}