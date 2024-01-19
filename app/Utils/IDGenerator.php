<?php

namespace App\Utils;

class IDGenerator
{
    private string $prefix = '';
    private string $model;
    private string $column;
    private bool $isNumberOnly = false;
    private bool $isRandom = false;
    private int $length = 5;

    public function __construct($model, $column, $prefix, $numberOnly = true)
    {
        $this->model = $model;
        $this->column = $column;
        $this->prefix = $prefix;
        $this->isNumberOnly = $numberOnly;
    }

    public function length(int $length)
    {
        $this->length = $length;
    }

    public function random(bool $random)
    {
        $this->isRandom = $random;
    }

    public function generate(int $index_number = 0)
    {
        $class = 'App\\Models\\' . $this->model;

        $startWith = strlen($this->prefix) + 1;

        if ($this->isRandom) {
            $randomGenerator = new RandomGenerator($this->isNumberOnly, false, $this->length);
            $full_random_string = $this->prefix.$randomGenerator->generate();
        } else {
            $full_random_string = $this->generateUniqueNumberIfExist($class, $startWith, $index_number);
        }

        return $this->regenerateIfExist($full_random_string, $index_number);
    }

    public function generateUniqueNumberIfExist($class, $startWith, $index_number)
    {
        if (class_exists($class)) {
            $last_record = $class::withTrashed()
                ->selectRaw("SUBSTRING(`{$this->column}`, ${startWith}) as `{$this->column}`")
                ->orderBy($this->column, 'desc')
                ->first();

            if ($index_number === 0) {
                $number = ($last_record ? $last_record->{$this->column} : 0);
                $last_unique_number = intval(preg_replace('/[^0-9]/', '', $number));
                $index_number = $last_unique_number + 1;
            } else {
                $index_number++;
            }
            $proposed_uniqued_number = sprintf('%0'.$this->length.'s', $index_number);

            return $this->prefix.$proposed_uniqued_number;
        }
    }

    public function regenerateIfExist($full_random_string, $index_number)
    {
        // check if database exist
        $class = 'App\\Models\\' . $this->model;
        if (class_exists($class)) {
            $found = $class::where([$this->column => $full_random_string])->first();
            if ($found === null) {
                return $full_random_string;
            }
            // call function recursively
            return $this->generate($index_number);
        }
        throw new \Exception('Failed to generate unique id');
    }
}
