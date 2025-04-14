<?php
namespace App\Repositories\Menu;

interface IMenuRepository
{
    public function getMenuByLevel($level);
}