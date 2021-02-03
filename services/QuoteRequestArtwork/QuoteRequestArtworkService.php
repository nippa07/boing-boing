<?php

namespace services\QuoteRequestArtwork;

use App\Models\QuoteRequest;
use App\Models\QuoteRequestArtwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use services\Facade\FileFacade;

class QuoteRequestArtworkService
{
    protected $quote_request_artwork;

    public function __construct()
    {
        $this->quote_request_artwork = new QuoteRequestArtwork();
    }

    public function get($id)
    {
        return $this->quote_request_artwork->find($id);
    }

    public function getAll()
    {
        return $this->quote_request_artwork->all();
    }

    public function create($data)
    {
        return $this->quote_request_artwork->create($data);
    }

    /**
     * update
     *
     * @param  mixed $quote_request_artwork
     * @param  mixed $data
     * @return void
     */
    public function update(QuoteRequestArtwork $quote_request_artwork, array $data)
    {
        return $quote_request_artwork->update($this->edit($quote_request_artwork, $data));
    }

    /**
     * edit
     *
     * @param  mixed $quote_request_artwork
     * @param  mixed $data
     */
    protected function edit(QuoteRequestArtwork $quote_request_artwork, $data)
    {
        return array_merge($quote_request_artwork->toArray(), $data);
    }

    public function delete($id)
    {
        $quote_request_artwork = $this->get($id);
        return $quote_request_artwork->delete();
    }

    public function make(QuoteRequest $quote_request, Request $request)
    {
        $request['quote_request_id'] = $quote_request->id;
        if ($request->has('artwork')) {
            foreach ($request->file('artwork') as $doc) {
                $request['name'] = FileFacade::up($doc)['data'];
                $this->create($request->all());
            }
        }
    }
}
