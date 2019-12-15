<?php

namespace App\Console\Commands;

use App\Category;
use App\Nominee;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportNominees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('importing nominees');
        $file = Storage::get('golden-globes.txt');
        $lines = explode("\n", $file);
        foreach ($lines as $index => $line) {
            if (empty($line)) {
                continue;
            }
            if ($index % 7 == 0){
                $this->addCategory($line);
                $this->info($line);
            } else {
                $category = Category::find(ceil($index/7));
                $this->addNominee($line, $category);
                $this->line($line);
            }
        }
        //dump($lines);
    }

    private function addCategory($line){
        $category = new Category;
        $category->type = 'person';
        if (strpos($line, "_") !== false){
            $category->type = "movie/show";
        }
        $category->name = ltrim($line, "_");
        $category->save();
    }

    private function addNominee($line, $category){
        $nominee = new Nominee;
        if ($category->type == "movie/show"){
            $nominee->name = trim($line, "\"");
        } else {
            // $re = '/([\w\ åé]+)\(\"([\w\ ]+)"\)/m';
            // preg_match_all($re, $line, $matches, PREG_SET_ORDER, 0);
            list ($name, $for) = explode(" (\"", $line);
            $nominee->name = trim($name, " ");
            $nominee->for = rtrim($for, "\")");
        }
        $nominee->category_id = $category->id;
        $nominee->save();
    }
}
