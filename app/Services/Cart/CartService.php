<?php

namespace App\Services\Cart;


class CartService
{
    const CART_KEY = 'cart';

    public function qty(): array
    {
        return $this->get();
    }

    public function itemsCount():int
    {
        return count($this->qty());

    }

    public function add(int $id, int $qty = 1): array
    {
        $items = $this->get();
        if (isset($items[$id])) {
            $items[$id] += $qty;
        } else {
            $items[$id] = $qty;
        }
        $this->set($items);
        return $items;
    }

    public function setQty(int $id, int $qty): array
    {
        $items = $this->get();
        if (isset($items[$id])) {
            $items[$id] = $qty;
            $this->set($items);
        }
        return $items;
    }

    public function increaseQty(int $id, int $qty = 1): array
    {
        $items = $this->get();
        if (isset($items[$id])) {
            $items[$id] += $qty;
            $this->set($items);
        }
        return $items;

    }

    public function decreaseQty(int $id, int $qty = 1): array
    {
        $items = $this->get();
        if (isset($items[$id])) {
            $items[$id] -= $qty;
            if ($items[$id] <= 0){
                unset($items[$id]);
            }
            $this->set($items);
        }
        return $items;
    }

    public function remove(int $id):array
    {
        $items = $this->get();
        if(isset($items[$id])) {
            unset($items[$id]);
            $this->set($items);
        }
        return $items;
    }

    public function clear(): array 
    {
        request()->session()->forget(self::CART_KEY);
        return [];
    }

    protected function get(): array 
    {
        return request()->session()->get(self::CART_KEY, []);
    }

    protected function set(array $items): void 
    {
         request()->session()->put(self::CART_KEY, $items);
    }









}
