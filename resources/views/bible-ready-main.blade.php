<div class="tab-pane container fade" id="bible-ready">
    <div class="card mb-3 border-0">
        <div class="row g-0">
            <div class="col-12">
                <div class="card-body">
                    <iframe
                        src="{{
                            \Transprime\Url\Url::make(
                                 fullDomain: url('/bible-ready'),
                                 query: ['book' => request('book', 'John')],
                            )
                        }}"
                        class="mt-2"
                        style="border: 0; width: 100%; height: 100%;"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
