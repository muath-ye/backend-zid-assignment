<?php

namespace App\Console\Commands;

use App\Services\StatisticsService;
use Illuminate\Console\Command;

class StatisticsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistics
                            {--all : Get all statistics.}
                            {--c|items-count : Total items count.}
                            {--a|average-price : Average price of an item.}
                            {--w|website-highest-total-price : The website with the highest total price of its items.}
                            {--l|last-month-total-price : Total price of items added this month.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve Items Statistics';

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
     * @return int
     */
    public function handle(StatisticsService $statisticsService)
    {
        if ($this->option('all') || !array_search(true, $this->options())) {
            $this->table(
                ['Statistics', 'Value'],
                [
                    ['items-count', $statisticsService->itemsCount()],
                    ['average-price', $statisticsService->averagePrice()],
                    ['website-highest-total-price', $statisticsService->websiteHighestTotalPrice()],
                    ['last-month-total-price', $statisticsService->lastMonthTotalPrice()],
                ],
            );
        }

        $this->option('items-count') ? $this->line($statisticsService->itemsCount()) : '';
        $this->option('average-price') ? $this->line($statisticsService->averagePrice()) : '';
        $this->option('website-highest-total-price') ? $this->line($statisticsService->websiteHighestTotalPrice()) : '';
        $this->option('last-month-total-price') ? $this->line($statisticsService->lastMonthTotalPrice()) : '';
    }
}
