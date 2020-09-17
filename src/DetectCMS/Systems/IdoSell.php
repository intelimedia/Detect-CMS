<?php
namespace DetectCMS\Systems;

/**
 *
 * @author Przemysław Prekurat <p.prekurat@intelimedia.pl>
 */
class IdoSell extends \DetectCMS\DetectCMS
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
            'checkHtmlHeader',
            'checkHtmlBody',
        );
    }

    /**
     * @return [boolean]
     */
    public function checkHtmlHeader()
    {
      if (preg_match("/<meta name=\"Author\" content=\"[^\"]+IdoSell/i", $this->home_html)) {
          return true;
      }

      return false;
    }

    /**
     * @return bool
     */
    public function checkHtmlBody()
    {
      if (stripos($this->home_html, "'iaiTracker'") !== false
        || strpos($this->home_html, "n.agent='plidosell'") !== false
      ) {
        return true;
      }

      return false;
    }
}