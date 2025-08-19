<?php
@extends('layouts.app')

@section('title', 'Historique des actions')

@section('content')
    <h2>Historique des actions</h2>

    @if($actionlogs->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Par</th>
                    <th>Détails</th>
                    <th>Quand</th>
                </tr>
            </thead>
            <tbody>
                @foreach($actionlogs as $log)
                    <tr>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->performedBy->fullName ?? '-' }}</td>
                        <td>{{ $log->details }}</td>
                        <td>{{ $log->timestamp }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun log trouvé.</p>
    @endif
@endsection

