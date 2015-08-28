<?php
/**
 * Created by PhpStorm.
 * User: Mihail
 * Date: 24.08.2015
 * Time: 20:07
 */
namespace common\component;

use yii\widgets\ListView;


class ListViewWithoutSummary extends ListView {

    /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{summary}`, `{items}`.
     * @return string|boolean the rendering result of the section, or false if the named section is not supported.
     */
    public function renderSummary()
    {
            return '';
    }
}