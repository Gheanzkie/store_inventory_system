<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'tbl_logs';
    protected $primaryKey = 'LOGID';
    protected $allowedFields = [
        'USERID', 'USER_NAME', 'ACTION', 'DATELOG', 'TIMELOG',
        'user_ip_address', 'device_used', 'identifier',
    ];

    public function addLog(string $action, string $type = '')
    {
        date_default_timezone_set('Asia/Manila');

        $session = session();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        
        // ✅ Format device info para mas maganda
        $deviceInfo = $this->getDeviceInfo($userAgent);
        
        $this->insert([
            'USERID'          => $session->get('id'),
            'USER_NAME'       => $session->get('name'),
            'ACTION'          => $action,
            'DATELOG'         => date('Y-m-d'),
            'TIMELOG'         => date('H:i:s'),
            'user_ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'device_used'     => $deviceInfo,
            'identifier'      => $type
        ]);
    }

    /**
     * Detect device and browser info
     */
    private function getDeviceInfo($userAgent)
    {
        $info = [];
        
        // Device Type
        if (preg_match('/mobile|android|iphone|ipad|ipod|blackberry|webos/i', $userAgent)) {
            if (preg_match('/ipad/i', $userAgent)) {
                $info[] = '📱 iPad';
            } elseif (preg_match('/iphone/i', $userAgent)) {
                $info[] = '📱 iPhone';
            } elseif (preg_match('/android/i', $userAgent)) {
                if (preg_match('/mobile/i', $userAgent)) {
                    $info[] = '📱 Android Phone';
                } else {
                    $info[] = '📱 Android Tablet';
                }
            } else {
                $info[] = '📱 Mobile Device';
            }
        } elseif (preg_match('/windows nt/i', $userAgent)) {
            $info[] = '💻 Windows PC';
        } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
            $info[] = '💻 MacBook/iMac';
        } elseif (preg_match('/linux/i', $userAgent)) {
            $info[] = '💻 Linux PC';
        } else {
            $info[] = '🖥️ Desktop';
        }
        
        // Browser
        if (preg_match('/firefox/i', $userAgent)) {
            $info[] = '🦊 Firefox';
        } elseif (preg_match('/chrome/i', $userAgent)) {
            if (preg_match('/edg/i', $userAgent)) {
                $info[] = '🌐 Edge';
            } elseif (preg_match('/opera|opr/i', $userAgent)) {
                $info[] = '🎭 Opera';
            } elseif (preg_match('/brave/i', $userAgent)) {
                $info[] = '🛡️ Brave';
            } else {
                $info[] = '🌐 Chrome';
            }
        } elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome/i', $userAgent)) {
            $info[] = '🧭 Safari';
        } elseif (preg_match('/msie|trident/i', $userAgent)) {
            $info[] = '📟 Internet Explorer';
        }
        
        // OS Version (optional)
        if (preg_match('/windows nt 10.0/i', $userAgent)) {
            $info[] = '(Windows 10/11)';
        } elseif (preg_match('/windows nt 6.3/i', $userAgent)) {
            $info[] = '(Windows 8.1)';
        } elseif (preg_match('/windows nt 6.1/i', $userAgent)) {
            $info[] = '(Windows 7)';
        } elseif (preg_match('/mac os x 10_15/i', $userAgent)) {
            $info[] = '(macOS Catalina)';
        } elseif (preg_match('/mac os x 11|12|13|14/i', $userAgent)) {
            $info[] = '(macOS Big Sur+)';
        }
        
        return implode(' ', $info);
    }

    public function getLogs()
    {
        return $this->orderBy('DATELOG DESC, TIMELOG DESC')->findAll();
    }

    public function getLogsByDate($date)
    {
        return $this->where('DATELOG', $date)
            ->orderBy('TIMELOG DESC')
            ->findAll();
    }

    public function getLogsByDateAndResid($date, $userId)
    {
        return $this->where('DATELOG', $date)
            ->where('USERID', $userId)
            ->orderBy('TIMELOG', 'DESC')
            ->findAll();
    }

    public function getLogsPerMonth()
    {
        return $this->db->query("
            SELECT 
                MONTH(STR_TO_DATE(DATELOG, '%Y-%m-%d')) AS month_num,
                COUNT(*) AS total_logs
            FROM tbl_logs
            WHERE DATELOG IS NOT NULL
            GROUP BY month_num
            ORDER BY month_num
        ")->getResultArray();
    }
}