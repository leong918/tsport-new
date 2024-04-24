<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\ProductAttributeTermRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowStockMail;
class CheckLowStockQuantity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:low_stock_quantity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check low stock quantity and send mail';

    private ProductRepository $productRepository;
    private ProductAttributeTermRepository $productAttributeTermRepository;
    private SettingRepository $settingRepository;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $productRepository, ProductAttributeTermRepository $productAttributeTermRepository, SettingRepository $settingRepository)
    {
        parent::__construct();
        $this->productRepository = $productRepository;
        $this->productAttributeTermRepository = $productAttributeTermRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();
        $formattedDate = $date->format('F j, Y');
        $product_list = $this->productRepository->getLowStockProduct();
        $product_attribute_term_list = $this->productAttributeTermRepository->getLowStockProductAttributeTerm();
        $receiver = $this->settingRepository->getValueByKey('notification_email');
        Mail::to($receiver)->send(new LowStockMail($product_list,$product_attribute_term_list,$formattedDate));
    }
}
