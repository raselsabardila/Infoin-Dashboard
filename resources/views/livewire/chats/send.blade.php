<div>
    @if ($contact != null)
        <div class="card chat-box" id="mychatbox">
            <div class="card-header">
                <h4 style="text-transform: capitalize">{{ $contact["name"] }}</h4>
            </div>
            <div class="card-body chat-content" style="overflow: scroll;overflow-x:hidden">
                @foreach ($chatMe as $item)
                    @if ($item->sender_id == $contact["id"])
                        <div class="chat-item chat-left">
                            <img 
                                @if ($contact["google_id"] != null)
                                    @php
                                        $path = explode("/",$contact["avatar"])
                                    @endphp
                                    @if ($path[0] == "storage")
                                        src="{{ asset($contact["avatar"]) }}"
                                    @else
                                        src="{{ $contact["avatar"] }}"
                                    @endif
                                @else
                                    @if ($contact["avatar"] != null)
                                        src="{{ asset($contact["avatar"]) }}"
                                    @else
                                    src="{{ asset("resources/images/default.svg") }}"
                                    @endif
                                @endif
                            >
                            <div class="chat-details">
                                @php
                                    $message = $decrypted = Crypt::decrypt($item->message);
                                @endphp
                            <div class="chat-text">{{ $message }}</div>
                                <div class="chat-time">{{ $item->created_at->format("H:i") }}</div>
                            </div>
                        </div>
                    @endif
                    @if ($item->sender_id == Auth::id())
                        <div class="chat-item chat-right" style="">
                            <img 
                                @if ($item->sender->google_id != null)
                                    @php
                                        $path = explode("/",$item->sender->avatar)
                                    @endphp
                                    @if ($path[0] == "storage")
                                        src="{{ asset($item->sender->avatar) }}"
                                    @else
                                        src="{{ $item->sender->avatar }}"
                                    @endif
                                @else
                                    @if ($item->sender->avatar != null)
                                        src="{{ asset($item->sender->avatar) }}"
                                    @else
                                    src="{{ asset("resources/images/default.svg") }}"
                                    @endif
                                @endif
                            >
                            <div class="chat-details">
                                @php
                                    $message = $decrypted = Crypt::decrypt($item->message);
                                @endphp
                                <div class="chat-text">{{ $message }}</div>
                                <div class="chat-time">{{ $item->created_at->format("H:i") }}</div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="card-footer chat-form">
                <form id="chat-form" wire:submit.prevent="storeMessage">
                    <input type="text" class="form-control" wire:model="message" required placeholder="Type a message">
                    <button type="submit" class="btn btn-primary">
                    <i class="far fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
