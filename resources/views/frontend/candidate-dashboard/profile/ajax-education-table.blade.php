@foreach ($candidateEducation as $education)
    <tr>
        <td>{{ $education->level }}</td>
        <td>{{ $education->degree }}</td>
        <td>{{ $education->year }}</td>
        <td>{!! $education->note !!}</td>
        <td>
            <a class="btn btn-warning btn-sm edit-education" data-bs-toggle="modal" data-bs-target="#educationModal"
                href="{{ route('candidate.educations.edit', $education->id) }}">Edit</a>
            <a class="btn btn-danger btn-sm delete-education"
                href="{{ route('candidate.educations.destroy', $education->id) }}">Delete</a>
        </td>
    </tr>
@endforeach
