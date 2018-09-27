<?php

function iterativeTree() {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hostinger";

// Create connection
    $conn = new mysqli($servername, $username, $password, $db);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM category";
    $query = $conn->query($sql);
    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $sub_data["id"] = $row["id"];
            $sub_data["name"] = $row["name"];
            $sub_data["parent"] = $row["parent"];
            $data[] = $sub_data;
        }
        foreach ($data as $key => &$value) {
            $output[$value["id"]] = &$value;
        }
        foreach ($data as $key => &$value) {
            if ($value["parent"] && isset($output[$value["parent"]])) {
                $output[$value["parent"]]["nodes"][] = &$value;
            }
        }
        foreach ($data as $key => &$value) {
            if ($value["parent"] && isset($output[$value["parent"]])) {
                unset($data[$key]);
            }
        }

        $root = [
            'name' => '0',
            'nodes' => $data
        ];

        $nodesToVisit = [$root];

        while (!empty($nodesToVisit)) {
            $currentNode = $nodesToVisit[0];
            array_shift($nodesToVisit);

            if (!isset($currentNode["nodes"])) {
                foreach ($currentNode["nodes"] as $val) {
                    $nodesToVisit[] = $val;
                }
            }

            $roo = $currentNode["name"];

            foreach ($currentNode['nodes'] as $val) {

                if ($roo == $val["parent"]) {
                    $user_tree_array[] = "<ul><li>" . $val["name"] . "</li>";
                    foreach ($val['nodes'] as $va) {
                        if ($val["id"] == $va["parent"]) {
                            $user_tree_array[] = "<ul><li>" . $va["name"] . "</li>";
                            if (isset($va['nodes'])) {
                                foreach ($va['nodes'] as $v) {
                                    if ($va["id"] == $v["parent"]) {
                                        $user_tree_array[] = "<ul><li>" . $v["name"] . "</li></ul></ul></ul>";
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }

    }
    return $user_tree_array;
}
