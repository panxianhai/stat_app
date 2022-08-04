<?php

namespace App\Admin\Metrics;

use App\Models\Visit;
use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Support\Carbon;

class WeekHome extends Card
{
    /**
     * 初始化卡片.
     */
    protected function init()
    {
        parent::init();

        $this->title('首页周统计');
    }

    /**
     * 渲染卡片内容.
     *
     * @return string
     */
    public function renderContent()
    {
        $content = parent::renderContent();
        $weekStart = Carbon::now()->startOfWeek();
        $data = Visit::where('created_at', '>=', $weekStart)->where('click_type', 1)->count();
        return <<<HTML
<div class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
    <h2 class="ml-1 font-lg-1">$data</h2>
</div>
HTML;
    }
}
