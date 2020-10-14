<div>
    <div class="komentar-form my-5">
        <form 
            @if ($parent != null)
                wire:submit.prevent="storeReply"
            @else
                wire:submit.prevent="setComment"
            @endif
        >
            <div class="form-group">
                @if ($parent != null)
                    <textarea class="form-control" placeholder="Reply" rows="3" wire:model="comment_input"></textarea>
                @else
                    <textarea class="form-control" placeholder="Komentar" rows="3" wire:model="comment_input"></textarea>
                @endif
            </div>
            <button type="submit" class="btn text-white float-right mb-5" style="background: #F8E7B3">
                @if ($parent != null)
                    Kirim Reply
                @else
                    Kirim Komentar
                @endif
            </button>
        </form>
    </div>
</div>
