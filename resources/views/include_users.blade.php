                          
                          @foreach($users as $user)
                            <div class="col-lg-6 col-md-6 col-12 userDiv">
                                <div class="blogcard">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="content">
                                                <div class="contentLeft">
                                                    <h4>{{$user->name}}</h4>
                                                    <h5>{{$user->designation->name}}</h5>
                                                </div>
                                                <div class="contentRight">
                                                    <p>{{$user->department->name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="appendHere">

                            </div>