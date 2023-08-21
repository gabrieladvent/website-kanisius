<table>
    <tr>
        <th></th>
    </tr>
    @forelse ($user->notifications as $notification)
    <tr>
        <td>{{ $notification->data['namasekolah'] }}</td>
    </tr>
    @empty
    <tr>
        <td>No record</td>
    </tr>
    @endforelse
</table>
