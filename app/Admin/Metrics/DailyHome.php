<?php

namespace App\Admin\Metrics;

use App\Models\Visit;
use Dcat\Admin\Widgets\Metrics\Card;

class DailyHome extends Card
{
    /**
     * 初始化卡片.
     */
    protected function init()
    {
        parent::init();

        $this->title('首页每日统计');
    }

    /**
     * 渲染卡片内容.
     *
     * @return string
     */
    public function renderContent()
    {
        $content = parent::renderContent();

        $data = Visit::where('created_at', '>=', date('Y-m-d'))->where('click_type', 1)->count();

        return <<<HTML
<div class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
    <h2 class="ml-1 font-lg-1">$data</h2>
</div>
HTML;
    }
}
