@foreach ($candidateExperience as $experience)
    <tr>
        <td>{{ $experience->company }}</td>
        <td>{{ $experience->department }}</td>
        <td>{{ $experience->designation }}</td>
        <td>{{ $experience->start }} -
            {{ $experience->currently_working === 1 ? 'Current' : $experience->end }}</td>
        <td>
            <a class="btn btn-warning btn-sm edit-experience" data-bs-toggle="modal" data-bs-target="#experienceModal"
                href="{{ route('candidate.experiences.edit', $experience->id) }}">Edit</a>
            <a class="btn btn-danger btn-sm delete-experience"
                href="{{ route('candidate.experiences.destroy', $experience->id) }}">Delete</a>
        </td>
    </tr>
@endforeach
