package com.rs.worldserver.model.player.command;

import org.runetoplist.VoteReward;
import com.rs.worldserver.model.player.Client;
import com.rs.worldserver.model.player.Command;
import com.rs.worldserver.Server;

public class Reward implements Command {

	public void execute(Client client, String command) {
		if (client.getActionAssistant().freeSlots() < 1) {
			client.getActionAssistant().sendMessage("Please make sure you have at least 1 free inventory space.");
		} else {
			VoteReward reward = Server.voteChecker.getReward(client.getPlayerName().replaceAll(" ", "_"));
			if(reward != null){
				switch(reward.getReward()){
				case 0:
					client.getActionAssistant().sendMessage("You voted for 50 Zamorak Brews.");
					client.getActionAssistant().addItem(2451, 50);
					break;
				case 1:
					client.getActionAssistant().sendMessage("You voted for 100 Saradomin Brews.");
					client.getActionAssistant().addItem(6686, 100);
					break;
				case 2:
					client.getActionAssistant().sendMessage("You voted for 10M Coins.");
					client.getActionAssistant().addItem(995, 10000000);
					break;
				case 3:
					client.getActionAssistant().sendMessage("You voted for a Mystery Box.");
					client.getActionAssistant().addItem(6199, 1);
					break;
				case 4:
					client.getActionAssistant().sendMessage("You voted for 2 Vote Tickets.");
					client.getActionAssistant().addItem(619, 2);
					break;
				case 5:
					client.getActionAssistant().sendMessage("You voted for 500 noted Manta Ray.");
					client.getActionAssistant().addItem(392, 500);
					break;
				case 6:
					int[][] barrageItems = {{560, 2000}, {565, 1000}, {555, 3000}};
					for (int i = 0; i < barrageItems.length; i++)
						client.getActionAssistant().addItem(barrageItems[i][0], barrageItems[i][1]);
					client.getActionAssistant().sendMessage("You voted for 500 Ice Barrage casts.");
					break;
				default:
					client.getActionAssistant().sendMessage("Reward not found - please screenshot this and send it to an Administrator.");
					break;
				}
				client.getActionAssistant().sendMessage("Thank you for voting.");
			} else {
				client.getActionAssistant().sendMessage("You have no items waiting for you.");
			}
		}
	}

}
