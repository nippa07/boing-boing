<?php

namespace services\QuoteRequest;

use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use services\Facade\QuoteRequestArtworkFacade;

class QuoteRequestService
{
    protected $quote_request;

    public function __construct()
    {
        $this->quote_request = new QuoteRequest();
    }

    public function get($id)
    {
        return $this->quote_request->find($id);
    }

    public function getAll()
    {
        return $this->quote_request->all();
    }

    public function create($data)
    {
        return $this->quote_request->create($data);
    }

    /**
     * update
     *
     * @param  mixed $quote_request
     * @param  mixed $data
     * @return void
     */
    public function update(QuoteRequest $quote_request, array $data)
    {
        return $quote_request->update($this->edit($quote_request, $data));
    }

    /**
     * edit
     *
     * @param  mixed $quote_request
     * @param  mixed $data
     */
    protected function edit(QuoteRequest $quote_request, $data)
    {
        return array_merge($quote_request->toArray(), $data);
    }

    public function delete($id)
    {
        $quote_request = $this->get($id);
        return $quote_request->delete();
    }

    public function make(Request $request)
    {
        $data = $request->all();
        $quote_request = $this->create($data);

        QuoteRequestArtworkFacade::make($quote_request, $request);
    }
}
