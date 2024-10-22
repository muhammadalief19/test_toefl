<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PrivateMessage;
use App\Events\PrivateMessageUpdated;
use App\Events\PrivateMessageDeleted;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PrivateMessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $messages = PrivateMessage::where('sender_id', $user->_id)
                    ->orWhere('recipient_id', $user->_id)
                    ->with('sender', 'recipient')
                    ->orderBy('sent_at', 'desc')
                    ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }

    public function sendMessage(Request $request)
    {
        $date = new Carbon();
        $validatedData = $request->validate([
            'recipient_id' => 'required',
            'message_content' => 'required',
        ]);

        $message = PrivateMessage::create([
            'sender_id' => auth()->user()->_id,
            'recipient_id' => $validatedData['recipient_id'],
            'message_content' => $validatedData['message_content'],
            'sent_at' => $date->now()->isoFormat('Y-M-D H:mm:ss'),
        ]);

        // Broadcast pesan baru
        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function updateMessage(Request $request, $messageId)
    {
        $date = new Carbon();
        // Validasi input
        $validatedData = $request->validate([
            'message_content' => 'required|string',
        ]);

        try {
            // Cari pesan berdasarkan ID
            $message = PrivateMessage::findOrFail($messageId);

            // Periksa apakah pengguna yang mengirim pesan adalah yang sedang login
            if ($message->sender_id != auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak berhak mengubah pesan ini.',
                ], 403);
            }

            // Update isi pesan

            $message->message_content = $validatedData['message_content'];
            $message->sent_at =$date->now()->isoFormat('Y-M-D H:mm:ss');
            $message->save();

            // Broadcast perubahan via Pusher
            broadcast(new PrivateMessageUpdated($message))->toOthers();

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil diperbarui.',
                'data' => $message,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui pesan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function deleteMessage($messageId)
    {
        try {
            // Cari pesan berdasarkan ID
            $message = PrivateMessage::findOrFail($messageId);

            // Periksa apakah pengguna yang mengirim pesan adalah yang sedang login
            if ($message->sender_id != auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak berhak menghapus pesan ini.',
                ], 403);
            }

            // Hapus pesan
            $message->delete();

            // Broadcast penghapusan via Pusher
            broadcast(new PrivateMessageDeleted($messageId))->toOthers();

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dihapus.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pesan: ' . $e->getMessage(),
            ], 500);
        }
    }

}
