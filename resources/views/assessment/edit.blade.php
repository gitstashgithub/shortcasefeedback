@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$examination->name}}</div>
                    <div class="panel-body">
                        {!! Form::model($assessment, ['action' => $action,'method' => $method]) !!}
                        {!! csrf_field() !!}
                        <input type="hidden" name="examinationId" value="{{ $examination->id }}">
                        @foreach($examination->items as $item)
                            <div class="row">
                                <div class="col-md-12">
                                    <h{{$item->depth+1}}>
                                        @if($item->isLeaf())
                                            <input class="item-required" data-id="{{$item->id}}" id="item-required-{{$item->id}}"
                                                   type="checkbox" {{$item->required?'checked':''}}>
                                        @endif
                                        <label for="item-required-{{$item->id}}" >{{$item->name}}</label>
                                    </h{{$item->depth+1}}>
                                </div>
                            </div>
                            <div id="item{{$item->id}}" style="{{$item->required?'block':'none'}}">
                                @if($item->isLeaf())
                                    <div class="row">
                                        @foreach($options as $option)
                                            <div class="col-md-4">
                                                <div class="button-style">
                                                    <label><input type="radio" name="items[{{$item->id}}]" data-id="{{$item->id}}"
                                                                  onchange="toggleTechniques({{$item->id}},this.value)"
                                                                  value="{{$option->id}}">
                                                        <span>{{$option->name}}</span></label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @if(count($item->techniques)>0)
                                    <div class="row" style="display:none" id="technique-{{$item->id}}">
                                        @foreach($item->techniques as $technique)
                                            <div class="col-md-4">
                                                <div class="button-style technique">
                                                    <label><input type="checkbox"
                                                                  name="item-techniques[{{$item->id}}][{{$technique->id}}]"
                                                                  value="1">
                                                        <span>{{$technique->name}}</span></label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('stylesheet')
    {!! Html::style('css/assessment.css')  !!}
@endsection
@section('scripts')
    {!! Html::style('js/assessment.js')  !!}
    <script>
        $(document).ready(function () {
            $('.item-required').click(function () {
                $('#item'+$(this).data('id')).toggle();
            });
        });
        function toggleTechniques(id,value){
            if(value==3){
                $('#technique-'+id).show();
            }else{
                $('#technique-'+id).hide();
            }

        }
    </script>
@endsection