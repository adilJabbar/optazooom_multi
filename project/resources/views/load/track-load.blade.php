                        @if(isset($apiResponse))
                    <div class="tracking-steps-area">
                        
                            <ul class="tracking-steps">

                                @if(isset($apiResponse->CompletedTrackDetails->TrackDetails->StatusDetail->Description))
                                {{$apiResponse->CompletedTrackDetails->TrackDetails->StatusDetail->Description}}
                                @endif
                                @if(isset($order))
                                @foreach($order->tracks as $track)
                                    <li class="{{ in_array($track->title, $datas) ? 'active' : '' }}">
                                        <div class="icon">{{ $loop->index + 1 }}</div>
                                        <div class="content">
                                                <h4 class="title">{{ ucwords($track->title)}}</h4>
                                                <p class="date">{{ date('d m Y',strtotime($track->created_at)) }}</p>
                                                <p class="details">{{ $track->text }}</p>
                                        </div>
                                    </li>
                                @endforeach
                                @endif

                                </ul>
                        
                    </div>


                        @else 
                        <h3 class="text-center">{{ $langg->lang775 }}</h3>
                        @endif          