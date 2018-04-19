<?php

namespace Devio\Pages\Generators\Concerns;

trait CompilesContent
{
    /**
     * The sources variables.
     *
     * @var array
     */
    protected $sources = [];

    /**
     * Perform the compilation and get the rendered result..
     *
     * @return mixed
     */
    public function compile($subject)
    {
        $pattern = sprintf('/%s(.*?)%s/s', '{{', '}}');

        $value = preg_replace_callback($pattern, function ($matches) {
            // Remove any whitespace as the result is not going to be used in a
            // HTML context. Also add the interpolation characters to ensure
            // the content is rendered either it's a variable or closure.
            return '{' . trim($matches[1]) . '}';
        }, $subject);

        return $this->evaluate($value);
    }

    /**
     * Perform the evaluation under the compiled string.
     *
     * @param $__value
     * @return mixed
     */
    protected function evaluate($__value)
    {
        extract($this->sources);

        eval("\$__value = \"$__value\";");

        return $__value;
    }

    /**
     * The sources variables.
     *
     * @param array $vars
     * @return $this
     */
    public function sources(array $vars = [])
    {
        $this->sources = $vars;

        return $this;
    }

    /**
     * Get the compiler sources.
     *
     * @return array
     */
    public function getSources()
    {
        return $this->sources;
    }
}