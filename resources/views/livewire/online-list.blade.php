<div>
    <div class="card">
        <div class="card-header">
            <h4>Siapa Yang Online?</h4>
            </div>
            <div class="card-body">
            <ul class="list-unstyled list-unstyled-border">
                @foreach ($onlines as $item)
                    <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="50" 
                            @if ($item->google_id != null)
                                @php
                                    $path = explode("/",$item->avatar)
                                @endphp
                                @if ($path[0] == "storage")
                                    src="{{ asset($item->avatar) }}"
                                @else
                                    src="{{ $item->avatar }}"
                                @endif
                            @else
                                @if ($item->avatar != null)
                                    src="{{ asset($item->avatar) }}"
                                @else
                                src="{{ asset("resources/images/default.svg") }}"
                                @endif
                            @endif
                        height="50px">
                        <div class="media-body">
                            <div class="mt-0 mb-1 font-weight-bold">{{ $item->name }}</div>
                            <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>  
    {{ $onlines->links("custom-pagination-links-view") }}
</div>
