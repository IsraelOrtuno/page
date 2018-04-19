<?php

namespace Devio\Seo\Transformers;

class MetaTransformer extends Transformer
{
    protected $robots = ['index', 'follow', 'nosnippet', 'noarchive', 'noimageindex'];

    /**
     * Casts the robots string booleans to real booleans.
     *
     * @param $content
     * @return array
     */
    public function setRobots($content)
    {
        // Iterating through all possible robot values to make sure all them
        // have a value as checkboxes in html do not include them into the
        // requests vars and will cause problems when saving and reading.
        foreach($this->robots as $value) {
            $content[$value] = $content[$value] ?? false;
        }


        $result = collect($content)->map(function ($value) {
            // We will iterate over the entire robots collection and cast every item
            // to a real boolean value. This way we will make sure we always store
            // bools rather than integers or strings which come from htm fields.
            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
        })->filter(function ($value, $key) {
            // If any of these keys are present in the array and are not true,
            // we wont store them and assume that their value will be false.
            return ! ($value == false && in_array($key, ['nosnippet', 'noarchive', 'noimageindex']));
        });

        // By default "index follow" go together, so if both of them are true
        // we can get rid of them as any search engine will threat the page
        // the same way as if they were not present. No need to be stored.
        return ($result->get('index') && $result->get('follow')) == true ?
            $result->except('index', 'follow') : $result->all();
    }
}