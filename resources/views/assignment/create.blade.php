@extends('layouts.app')

@section ('title')
<title>Vue</title>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               
            <div class="panel-heading">Add a New Assignment</div>
            <div class="panel-body">


<form class="form-horizontal" role="form" method="POST" action="{{ url('/assignment') }}">
        
{!! csrf_field() !!}
{!! Form::hidden('section_id', $section->id) !!}


<!-- Title -->

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    
            <label class="col-md-4 control-label">Title</label>

            <div class="col-md-6">
             
        <div>{!! Form::text('title', null, ['class' => 'form-control']) !!}</div>

             @if ($errors->has('title'))
            
                 <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                 </span>
                 
             @endif
            
            </div>
        </div>


<!-- Description -->

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    
            <label class="col-md-4 control-label">Description</label>

            <div class="col-md-6">

        <div>{!! Form::text('description', null, ['class' => 'form-control']) !!}</div>

              @if ($errors->has('description'))
            
                 <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                 </span>
                 
             @endif
            
            </div>
        </div>

             
<!-- Components -->

        <div id="app" class="form-group{{ $errors->has('components') ? ' has-error' : '' }}">

            <label class="col-md-4 control-label">Primary Artifact</label>

            <div class="col-md-6">
            <div  v-for="row in rows" class="input-group">
      
<!-- <input name="components[]" class="form-control" type="text" v-model="row.title">-->

<input name="components[title][]" class="form-control" type="text" v-model="row.title">       
        <span class="input-group-btn">
     
        <button class="btn btn-danger" type="button" @click.prevent="removeRow(row)">x</button>
        <button class="btn btn-primary" @click.prevent="addRow">+</button>

        </span>
    
            </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->








            @if ($errors->has('components'))

                 <span class="help-block">
                    <strong>{{ $errors->first('components') }}</strong>
                 </span>
                 
             @endif
    
        </div> 


<!-- Due Date -->


 <div class="form-group{{ $errors->has('date_due') ? ' has-error' : '' }}">
                                    
            <label class="col-md-4 control-label">Due Date</label>

            <div class="col-md-6">

            <div>{!! Form::date('date_due', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}</div>

            </div>
</div>
        
        
<div class="form-group">

            <label class="col-md-4 control-label"></label>

            <div class="col-md-6">
                
                <button type="submit" class="btn btn-primary">
                    Add Assignment
                </button>

            </div>
        </div>
        
</div>
    
</form>

@endsection


<script src="https://unpkg.com/vue@2.1.10/dist/vue.js"></script>


