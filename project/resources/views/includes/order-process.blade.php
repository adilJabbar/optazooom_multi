
@if($order->status == 'pending' ||$order->status == 'paid' )

                                    <ul class="process-steps">
                                            <li class="active">
                                                <div class="icon">1</div>
                                                <div class="title">Paid</div>
                                            </li>
                                            <li class="">
                                                <div class="icon">2</div>
                                                <div class="title">Processing</div>
                                            </li>
                                            <li class="">
                                                <div class="icon">3</div>
                                                <div class="title">Shipped</div>
                                            </li>
                                            <li class="">
                                                <div class="icon">4</div>
                                                <div class="title">Delivered</div>
                                            </li>
                                    </ul>

@elseif($order->status == 'processing')

                                    <ul class="process-steps">
                                            <li class="active">
                                                <div class="icon">1</div>
                                                <div class="title">Paid</div>
                                            </li>
                                            <li class="active">
                                                <div class="icon">2</div>
                                                <div class="title">Processing</div>
                                            </li>
                                            <li class="">
                                                <div class="icon">3</div>
                                                <div class="title">Shipped</div>
                                            </li>
                                            <li class="">
                                                <div class="icon">4</div>
                                                <div class="title">Delivered</div>
                                            </li>
                                    </ul>


@elseif($order->status == 'shipped')


                                    <ul class="process-steps">
                                            <li class="active">
                                                <div class="icon">1</div>
                                                <div class="title">Paid</div>
                                            </li>
                                            <li class="active">
                                                <div class="icon">2</div>
                                                <div class="title">Processing</div>
                                            </li>
                                            <li class="active">
                                                <div class="icon">3</div>
                                                <div class="title">Shipped</div>
                                            </li>
                                            <li class="">
                                                <div class="icon">4</div>
                                                <div class="title">Delivered</div>
                                            </li>
                                    </ul>

@elseif($order->status == 'delivered')

                                    <ul class="process-steps">
                                            <li class="active">
                                                <div class="icon">1</div>
                                                <div class="title">Paid</div>
                                            </li>
                                            <li class="active">
                                                <div class="icon">2</div>
                                                <div class="title">Processing</div>
                                            </li>
                                            <li class="active">
                                                <div class="icon">3</div>
                                                <div class="title">Shipped</div>
                                            </li>
                                            <li class="active">
                                                <div class="icon">4</div>
                                                <div class="title">Delivered</div>
                                            </li>
                                    </ul>

@endif
