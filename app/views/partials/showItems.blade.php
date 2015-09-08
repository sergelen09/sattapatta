@forelse ($items as $item)
    <div class="col-md-3 col-sm-6">
      <div class="thumbnail">
        <div class="caption">
            By {{ HTML::linkRoute('users.profile', $item->user->username, $item->user->username) }} 
            <span class="pull-right">{{ $item->created_at->diffForHumans() }}</span>
        </div>
        <!-- <img src="http://placehold.it/800x500" alt=""> -->
        <div class="center-block">
          <a href="{{URL::route('items.show', [$item->user->username, $item->name, $item->id])}}">
            @if(!$item->images->first())
              {{ HTML::image('images/placeholder.png', null, ['style'=>'height:150px', 'class'=>'img-responsive']) }}
            @else
              {{ HTML::image($item->images->first()->imageUrl, null, ['style'=>'height:150px', 'class'=>'img-responsive']) }}
            @endif
          </a>

        </div>
        <div class="caption">
          <strong>{{ $item->name }}</strong>
          <span class="pull-right">
            @if(Auth::check())
              @if(Auth::user()->username != $item->user->username)
                <a href="#">
                  <i class="fa fa-thumb-tack"></i>
                </a>
              @else
                <a href="{{URL::route('item.edit', [$item->user->username, $item->name, $item->id])}}">
                  <i class="fa fa-edit"></i>
                </a>
              @endif
            @endif
          </span>
          <p data-toggle="tooltip" data-placement="bottom" title="{{ $item->description }}">
            {{ $item->description }}
          </p>

        </div>

      </div>
    </div>
    <!-- /.col -->
    
    @empty
      <p class="text-muted">No items</p>

    @endforelse