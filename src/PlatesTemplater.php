<?php
/**
 * 'What you leave behind is not what is engraved in stone monuments, but what is woven into the lives of others.'
 * - Pericles
 *
 * PHP Plates wrapper
 * @http://platesphp.com/
 *
 * Class to instantiate and render view templates
 */

namespace MillieOfzo\Plates;

use League\Plates\Engine as PlatesEngine;
use Illuminate\Contracts\View\Engine as EngineInterface;

class PlatesTemplater implements EngineInterface
{
    /** @var PlatesEngine */
    private $engine;

    public function __construct(PlatesEngine $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Get the evaluated contents of the view.
     *
     * @param  string  $path
     * @param  array   $data
     * @return string
     */
    public function get($path, array $data = [])
    {
        $path = substr($path, strlen($this->engine->getDirectory()));
        $path = substr($path, 0, -strlen('.' . $this->engine->getFileExtension()));

        if (isset($data['shared']))
        {
            $this->addData($data, $data['shared']);
            unset($data['shared']);
        }

        return $this->engine->render($path, $data);
    }

    public function addData(array $data = [], array $shared_views = [])
    {
        $this->engine->addData($data, $shared_views);
    }
}
