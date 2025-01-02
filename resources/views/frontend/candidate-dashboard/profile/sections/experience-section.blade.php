<div class="tab-pane fade show" id="pills-experience" role="tabpanel" aria-labelledby="pills-experience-tab">
    <div>
        <div class="d-flex justify-content-between">
            <h4>Experience</h4>
            <button class="btn btn-primary"
                    onclick="$('#experienceForm').trigger('reset'); editId = ''; editMode = false"
                    data-bs-toggle="modal" data-bs-target="#experienceModal">Add Experience
            </button>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Company</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Period</th>
                <th style="width: 20%">Action</th>
            </tr>
            </thead>
            <tbody class="experience-tbody">
            @forelse ($candidateExperiences as $candidateExperience)
                <tr>
                    <td>{{ $candidateExperience->company }}</td>
                    <td>{{ $candidateExperience->department }}</td>
                    <td>{{ $candidateExperience->designation }}</td>
                    <td>{{ $candidateExperience->start }} -
                        {{ $candidateExperience->currently_working === 1 ? 'Current' : $candidateExperience->end }}
                    </td>
                    <td>
                        <a class="btn btn-warning btn-sm edit-experience" data-bs-toggle="modal"
                           data-bs-target="#experienceModal"
                           href="{{ route('candidate.experiences.edit', $candidateExperience->id) }}">Edit</a>
                        <a class="btn btn-danger btn-sm delete-experience"
                           href="{{ route('candidate.experiences.destroy', $candidateExperience->id) }}">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5 text-center">No data found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- -------------------------------------- --}}
    <br>
    <br>

    <div>
        <div class="d-flex justify-content-between">
            <h4>Education</h4>
            <button class="btn btn-primary"
                    onclick="$('#educationForm').trigger('reset'); editEducationId = ''; editEducationMode = false"
                    data-bs-toggle="modal" data-bs-target="#educationModal">Add Education
            </button>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Level</th>
                <th>Degree</th>
                <th>Year</th>
                <th>Note</th>
                <th style="width: 20%">Action</th>
            </tr>
            </thead>
            <tbody class="education-tbody">
            @forelse ($candidateEducation as $education)
                <tr>
                    <td>{{ $education->level }}</td>
                    <td>{{ $education->degree }}</td>
                    <td>{{ $education->year }}</td>
                    <td>{!! $education->note !!}</td>
                    <td>
                        <a class="btn btn-warning btn-sm edit-education" data-bs-toggle="modal"
                           data-bs-target="#educationModal"
                           href="{{ route('candidate.educations.edit', $education->id) }}">Edit</a>
                        <a class="btn btn-danger btn-sm delete-education"
                           href="{{ route('candidate.educations.destroy', $education->id) }}">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5 text-center">No data found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
