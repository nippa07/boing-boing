<?php

namespace services\QuoteItem;

use App\Models\Quote;
use App\Models\QuoteItem;

class QuoteItemService
{
    protected $quote_item;

    public function __construct()
    {
        $this->quote_item = new QuoteItem();
    }

    public function get($id)
    {
        return $this->quote_item->find($id);
    }

    public function getAll()
    {
        return $this->quote_item->all();
    }

    public function create($data)
    {
        return $this->quote_item->create($data);
    }

    /**
     * update
     *
     * @param  mixed $quote_item
     * @param  mixed $data
     * @return void
     */
    public function update(QuoteItem $quote_item, array $data)
    {
        return $quote_item->update($this->edit($quote_item, $data));
    }

    /**
     * edit
     *
     * @param  mixed $quote_item
     * @param  mixed $data
     */
    protected function edit(QuoteItem $quote_item, $data)
    {
        return array_merge($quote_item->toArray(), $data);
    }

    public function delete($id)
    {
        $quote_item = $this->get($id);
        return $quote_item->delete();
    }

    public function make(Quote $quote, $form_data)
    {
        $data['quote_id'] = $quote->id;

        for ($i = 0; $i < count($form_data['quantity']); $i++) {
            // $data['name'] = $form_data['name'][$i];
            $data['quantity'] = $form_data['quantity'][$i];
            $data['price'] = $form_data['price'][$i];
            $data['description'] = $form_data['description'][$i] ? $form_data['description'][$i] : '';
            $data['type'] = $form_data['type'][$i];
            $data['t_time'] = $form_data['t_time'][$i];
            $data['finishing'] = $form_data['finishing'][$i];
            $data['vinyl_type'] = $form_data['vinyl_type'][$i];
            $data['sticker_size'] = $form_data['sticker_size'][$i];
            $data['corners'] = $form_data['corners'][$i];

            $this->create($data);
        }
    }

    public function updateQuoteItem(Quote $quote, $form_data)
    {
        if (count($form_data['quantity']) > 0) {
            foreach ($quote->quote_item as $key => $quote_item) {
                $quote_item->delete();
            }
        }

        $this->make($quote, $form_data);
    }
}
