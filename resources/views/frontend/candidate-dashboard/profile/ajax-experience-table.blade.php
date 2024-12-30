@foreach ($candidateExperiences as $candidateExperience)
    <tr>
        <td>{{ $candidateExperience->company }}</td>
        <td>{{ $candidateExperience->department }}</td>
        <td>{{ $candidateExperience->designation }}</td>
        <td>{{ $candidateExperience->start }} -
            {{ $candidateExperience->currently_working === 1 ? 'Current' : $candidateExperience->end }}</td>
        <td>
            <a class="btn btn-warning btn-sm edit-experience" data-bs-toggle="modal" data-bs-target="#experienceModal"
                href="{{ route('candidate.experiences.edit', $candidateExperience->id) }}">Edit</a>
            <a class="btn btn-danger btn-sm delete-experience"
                href="{{ route('candidate.experiences.destroy', $candidateExperience->id) }}">Delete</a>
        </td>
    </tr>
@endforeach
