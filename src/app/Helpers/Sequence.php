<?php

namespace App\Helpers;

class Sequence
{
    /**
     * The sequence of return values.
     *
     * @var array
     */
    public $sequence;

    /**
     * The count of the sequence items.
     *
     * @var int
     */
    protected $count;

    /**
     * The current index of the sequence.
     *
     * @var int
     */
    protected int $index = 0;

    /**
     * Create a new sequence instance.
     *
     * @param array $source
     * @param string $factory_column
     * @param string $source_id
     */
    public function __construct(array $source, string $factory_column, string $source_id = 'id')
    {

        $map_source_values = fn($item) => [$factory_column => $item[$source_id]];
        $this->sequence = array_map($map_source_values, $source);
        $this->count = count($source);
    }


    /**
     * Get the next value in the sequence.
     *
     * @return mixed
     */
    public function __invoke()
    {
        if ($this->index > ($this->count - 1)) {
            $this->index = 0;
        }

        return tap($this->sequence[$this->index], function () {
            $this->index = $this->index + 1;
        });
    }
}
