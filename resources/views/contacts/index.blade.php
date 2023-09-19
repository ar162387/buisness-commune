@extends('layouts.main')


@section('content')
    

<main class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header card-title">
                <div class="d-flex align-items-center">
                  <h2 class="mb-0">All Contacts</h2>
                  <div class="ml-auto">
                    <a href="{{route("contacts.create")}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                  </div>
                </div>
              </div>
            <div class="card-body">
              <form >
                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col">
                
                          <select class="custom-select" name="company_id" id='search-select' onchange="this.form.submit()">
                            <option value="" selected>All Companies</option>
                            @foreach ($companies as $id => $name)
                     <option value="{{ $id }}" @if($id == request()->query("company_id")) selected @endif>{{ $name }}</option>
                             @endforeach
                          </select>
                
                      </div>
                      <div class="col">
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Search..." name="search" value ="{{request()->query('search') }}" id="search-input" aria-label="Search..." aria-describedby="button-addon2">
                          <div class="input-group-append">
                            @if (request()->filled('search')  || request()->filled('company_id'))
                
                
                              <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('search-input').value = '', document.getElementById('search-select').selectedIndex = 0 , this.form.submit()">
                                  <i class="fa fa-refresh"></i>
                                </button>
                                @endif
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                              <i class="fa fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>

              @if ($message = session('message'))
              <div class="alert alert-success">
                {{$message}}
              </div>
                  
              @endif
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Company</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>


                     @forelse ($contacts as $index => $contact)
                  <tr>
                    
                    <th scope="row">{{$contacts->firstItem() + $index}}</th>
                    <td>{{$contact->first_name}}</td>
                    <td>{{$contact->last_name}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->company->name}}</td>
                    <td width="150">
                      <a href="{{route("contacts.show" , $contact->id)}}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
                      <a href="{{route("contacts.edit" , $contact->id)}}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                      <form action="{{route('contacts.destroy' , $contact->id)}}" method='POST' onsubmit="return confirm('Are you sure?')" style='display:inline'>
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete"   ><i class="fa fa-times"></i></button>
                      </form>
                    </td>
                 
                    
                  </tr>
                  @empty
                  
            <tr>
                <td colspan="6">
                    <div class="alert alert-danger">
                          No Contacts Found
                          </div>
                </td>
            </tr>
                    
    
                      
                  @endforelse

                  

                </tbody>
              </table> 

              {{$contacts->withQueryString()->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


  
@endsection
    
@section('title' , 'All Contacts')