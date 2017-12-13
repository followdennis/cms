<?php

use Illuminate\Database\Seeder;

class LiZhiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $words = "耕 耗 艳 泰 珠 班 素 蚕 顽 盏 匪 捞 栽 捕 振 载 赶 起 盐 捎 捏 埋 捉 捆 捐 损 都 哲 逝 捡 换 挽 
热 恐 壶 挨 耻 耽 恭 莲 莫 荷 获 晋 恶 真 框 桂 档 桐 株 桥 桃 格 校 核 样 根 索 哥 速 逗 栗 配 
翅 辱 唇 夏 础 破 原 套 逐 烈 殊 顾 轿 较 顿 毙 致 柴 桌 虑 监 紧 党 晒 眠 晓 鸭 晃 晌 晕 蚊 哨 
哭 恩 唤 啊 唉 罢 峰 圆 贼 贿 钱 钳 钻 铁 铃 铅 缺 氧 特 牺 造 乘 敌 秤 租 积 秧 秩 称 秘 透 笔 
笑 笋 债 借 值 倚 倾 倒 倘 俱 倡 候 俯 倍 倦 健 臭 射 躬 息 徒 徐 舰 舱 般 航 途 拿 爹 爱 颂 翁 
脆 脂 胸 胳 脏 胶 脑 狸 狼 逢 留 皱 饿 恋 桨 浆 衰 高 席 准 座 脊 症 病 疾 疼 疲 效 离 唐 资 凉 
站 剖 竞 部 旁 旅 畜 阅 羞 瓶 拳 粉 料 益 兼 烤 烘 烦 烧 烛 烟 递 涛 浙 涝 酒 涉 消 浩 海 涂 浴 
浮 流 润 浪 浸 涨 烫 涌 悟 悄 悔 悦 害 宽 家 宵 宴 宾 窄 容 宰 案 请 朗 诸 读 扇 袜 袖 袍 被 祥 
课 谁 调 冤 谅 谈 谊 剥 恳 展 剧 屑 弱 陵 陶 陷 陪 娱 娘 通 能 难 预 桑 绢 绣 验 继 ";
        $word_arr = explode(" ",$words);
        $data = [];
        for($i = 1 ; $i<= 1000; $i++){
            $rand_keys = array_rand($word_arr,8);
            $title = '';
            foreach($rand_keys as $key){
                $title .= $word_arr[$key];
            }

            $rand_keys2 = array_rand($word_arr,50);
            $content = '';
            foreach($rand_keys2 as $key2){
                $content .= $word_arr[$key2];
            }
            $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            array_push($data,[
                'name'=>$i."--".$title,
                'title'=>$i."---".$title,
                'content'=>$content,
                'created_at'=>$now
            ]);
            if($i % 1000 == 0){
                \DB::beginTransaction();
                \DB::table('lizhi')->insert($data);
                \DB::commit();
                $data = [];
            }
        }
    }
}
