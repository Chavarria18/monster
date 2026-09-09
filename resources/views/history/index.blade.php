<x-app>

    <x-slot:title>
        History
    </x-slot:title>

    <style>
        .history-container {
            max-width: 1000px;
            margin: 30px auto;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .history-table th {
            background-color: #5a3d24;
            color: white;
            padding: 12px;
        }

        .history-table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .monster-name {
            font-weight: bold;
        }

        .winner {
            font-weight: bold;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .action-btn {
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .view-btn {
            background-color: #3498db;
            color: white;
        }

        .delete-btn {
            background-color: #c0392b;
            color: white;
        }
    </style>


    <div class="history-container">

        <table class="history-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fighter 1</th>
                    <th>Fighter 2</th>
                    <th>Winner</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($history as $combat)

                    <tr>

                        <td>
                            {{ $combat->id }}
                        </td>

                        <td class="monster-name">
                            {{ $combat->fighter1->name ?? 'Deleted monster' }}
                        </td>

                        <td class="monster-name">
                            {{ $combat->fighter2->name ?? 'Deleted monster' }}
                        </td>

                        <td class="winner">
                            🏆 {{ $combat->winnerMonster->name ?? 'No winner' }}
                        </td>

                        <td>
                            {{ $combat->created_at->format('Y-m-d H:i') }}
                        </td>

                        <td>

                            <div class="actions">



                                <form action="{{ route('combat.destroy', $combat->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="action-btn delete-btn"
                                        onclick="return confirm('Delete this combat?')">
                                        🗑️
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6">
                            No combat history found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>


        <div class="pagination">
            {{ $history->links() }}
        </div>

    </div>

</x-app>